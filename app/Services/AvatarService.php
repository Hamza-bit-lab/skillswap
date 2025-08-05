<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class AvatarService
{
    /**
     * Upload and process avatar image
     *
     * @param UploadedFile $file
     * @return string The path to the stored avatar
     */
    public function uploadAvatar(UploadedFile $file): string
    {
        // Generate unique filename
        $filename = $this->generateUniqueFilename($file);
        
        // Create the avatars directory if it doesn't exist
        if (!Storage::disk('public')->exists('avatars')) {
            Storage::disk('public')->makeDirectory('avatars');
        }
        
        // Process and resize the image
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file->getRealPath());
        
        // Resize to 300x300 pixels while maintaining aspect ratio
        $image->cover(300, 300);
        
        // Convert to JPEG for consistency and compression
        $encodedImage = $image->toJpeg(85);
        
        // Store the processed image
        $path = 'avatars/' . $filename;
        Storage::disk('public')->put($path, $encodedImage);
        
        return $path;
    }
    
    /**
     * Delete old avatar file
     *
     * @param string|null $avatarPath
     * @return bool
     */
    public function deleteOldAvatar(?string $avatarPath): bool
    {
        if ($avatarPath && Storage::disk('public')->exists($avatarPath)) {
            return Storage::disk('public')->delete($avatarPath);
        }
        
        return true;
    }
    
    /**
     * Get avatar URL or default
     *
     * @param string|null $avatarPath
     * @return string
     */
    public function getAvatarUrl(?string $avatarPath): string
    {
        if ($avatarPath && Storage::disk('public')->exists($avatarPath)) {
            return asset('storage/' . $avatarPath);
        }
        
        return asset('assets/images/default-avatar.jpg');
    }
    
    /**
     * Validate avatar file
     *
     * @param UploadedFile $file
     * @return array
     */
    public function validateAvatar(UploadedFile $file): array
    {
        $errors = [];
        
        // Check file size (max 3MB)
        if ($file->getSize() > 3072 * 1024) {
            $errors[] = 'Avatar file size must be less than 3MB.';
        }
        
        // Check file type
        $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            $errors[] = 'Avatar must be a JPEG or PNG image.';
        }
        
        // Check image dimensions - only minimum requirement
        $imageInfo = getimagesize($file->getRealPath());
        if ($imageInfo) {
            $width = $imageInfo[0];
            $height = $imageInfo[1];
            
            // Minimum dimensions only
            if ($width < 100 || $height < 100) {
                $errors[] = 'Avatar image must be at least 100x100 pixels.';
            }
        }
        
        return $errors;
    }
    
    /**
     * Generate unique filename for avatar
     *
     * @param UploadedFile $file
     * @return string
     */
    private function generateUniqueFilename(UploadedFile $file): string
    {
        $extension = 'jpg'; // Always save as JPG for consistency
        $timestamp = now()->format('YmdHis');
        $random = Str::random(8);
        
        return "avatar_{$timestamp}_{$random}.{$extension}";
    }
    
    /**
     * Create thumbnail version of avatar
     *
     * @param string $avatarPath
     * @return string
     */
    public function createThumbnail(string $avatarPath): string
    {
        $thumbnailPath = str_replace('avatars/', 'avatars/thumbs/', $avatarPath);
        
        // Create thumbnails directory if it doesn't exist
        if (!Storage::disk('public')->exists('avatars/thumbs')) {
            Storage::disk('public')->makeDirectory('avatars/thumbs');
        }
        
        // Load the original image
        $manager = new ImageManager(new Driver());
        $image = $manager->read(Storage::disk('public')->path($avatarPath));
        
        // Create 100x100 thumbnail
        $image->cover(100, 100);
        
        // Save thumbnail
        Storage::disk('public')->put($thumbnailPath, $image->toJpeg(85));
        
        return $thumbnailPath;
    }
}