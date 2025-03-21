<?php

namespace App\Services\Etl\Sources\Olx;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use App\Exceptions\ExtractorUrlException;
use App\Exceptions\ExtractorResponseException;

class ListingExtractor
{
    private bool $skip_cache = true;

    private bool $parse_from_js = true;

    public function execute(string $url): array
    {
        if (empty($url)) {
            throw new ExtractorUrlException;
        }

        $html = $this->fetch($url);

        return [
            'url' => $url,
            ...$this->parse($html),
        ];
    }

    private function fetch(string $url)
    {
        $key = md5($url);

        Log::debug(__METHOD__, ['url' => $url]);

        if ($this->skip_cache || !Cache::has($key)) {

            $response = Http::get($url);

            if ($response->failed()) {
                throw new ExtractorResponseException();
            }

            $html = $response->body();

            // Storage::put('html' . "/$key.html", $html);

            Cache::put($key, $html, now()->addHour());

        }

        return Cache::get($key);
    }

    private function parse(string $html): array
    {
        $doc = new \DOMDocument();
        @$doc->loadHTML($html);
        $xpath = new \DOMXPath($doc);

        if ($this->parse_from_js) {
            $script = $xpath->query("//script[@type='application/ld+json']")->item(0)?->textContent;
            $data = json_decode($script, true);
            $title = $data['name'];
            $price = $data['offers']['price'];
        } else {
            $title = $xpath->query("//h4[contains(@class, 'css-10ofhqw')]")->item(0)?->textContent;
            $price = $xpath->query("//h3[contains(@class, 'css-fqcbii')]")->item(0)?->textContent;
        }

        return [
            'title' => trim($title ?? ''),
            'price' => (float) trim($price ?? 0.00),
        ];
    }
}