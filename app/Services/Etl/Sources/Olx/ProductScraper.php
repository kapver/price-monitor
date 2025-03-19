<?php

namespace App\Services\Etl\Sources\Olx;

use App\Exceptions\ScraperResponseException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProductScraper
{
    public function scrape(string $url): array
    {
        $json = true;
        $html = $this->fetch($url);

        $doc = new \DOMDocument();
        @$doc->loadHTML($html);
        $xpath = new \DOMXPath($doc);

        if ($json) {
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

    private function fetch(string $url)
    {
        $key = md5($url);

        if (!Cache::has($key)) {
            $response = Http::get($url);

            if ($response->failed()) {
                throw new ScraperResponseException();
            }

            $html = $response->body();
            Storage::put('html' . "/$key.html", $html);
            Cache::put($key, $html, now()->addHour());

        }

        return Cache::get($key);
    }
}