<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [
            // Halaman utama
            URL::to('/'),

            // Informasi
            URL::to('/user/informasi/dataPengajar'),
            URL::to('/user/informasi/visiDanMisi'),
            URL::to('/user/informasi/dataMurid'),
            URL::to('/user/informasi/jadwal'),
            URL::to('/user/informasi/riwayatMurid'),

            // Galeri
            URL::to('/user/galeri'),

            // Pendaftaran
            URL::to('/user/pendaftaran'),

            // Kontak
            URL::to('/user/kontak'),

            // Testimoni
            URL::to('/user/testimoni'),
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . $url . '</loc>';
            $xml .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)
                ->header('Content-Type', 'application/xml');
    }
}
