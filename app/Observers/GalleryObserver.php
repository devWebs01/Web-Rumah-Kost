<?php

namespace App\Observers;

use App\Models\Gallery;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class GalleryObserver
{
    /**
     * Handle the Gallery "created" event.
     */
    protected function optimizeImage(string $relativePath): void
    {
        $fullPath = storage_path('app/public/'.ltrim($relativePath, '/'));

        if (file_exists($fullPath)) {
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($fullPath);
        }
    }

    public function created(Gallery $gallery): void
    {
        // Jika image-nya kosong, keluar
        if (! $gallery->image) {
            return;
        }
        $this->optimizeImage($gallery->image);
    }

    public function updated(Gallery $gallery): void
    {
        // Jika kolom image mengalami perubahan, baru dioptimasi ulang
        if ($gallery->wasChanged('image')) {
            $this->optimizeImage($gallery->image);
        }
    }

    /**
     * Handle the Gallery "deleted" event.
     */
    public function deleted(Gallery $gallery): void
    {
        //
    }

    /**
     * Handle the Gallery "restored" event.
     */
    public function restored(Gallery $gallery): void
    {
        //
    }

    /**
     * Handle the Gallery "force deleted" event.
     */
    public function forceDeleted(Gallery $gallery): void
    {
        //
    }
}
