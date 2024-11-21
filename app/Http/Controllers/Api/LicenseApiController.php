<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LicenseRecords;
use App\Models\Product;
use Illuminate\Http\Request;

class LicenseApiController extends Controller
{
    public function verifyLicense(Request $request)
    {
        $licenseKey = $request->input('license_key');
        $telegramUserId = $request->input('telegram_user_id'); 
        $deviceIdentifier = $request->input('device_identifier'); 
      

        // Find the license record based on the license key
        $licenseRecord = LicenseRecords::whereHas('license', function ($query) use ($licenseKey) {
            $query->where('license_key', $licenseKey);
        })->first();

        if ($licenseRecord) { 

            // Check if the license has already been used
            if ($licenseRecord->device_identifier) {
                return response()->json(['success' => false, 'message' => 'This license has already been used.']);
            }
                // Check license expiration
                $licenseCreationDate = $licenseRecord->created_at;
                $licenseDurationMonths = $licenseRecord->license->type;
                $expirationDate = $licenseCreationDate->addMonths($licenseDurationMonths);

                if (now()->greaterThan($expirationDate)) {
                    return response()->json(['success' => false, 'message' => 'Your license has expired. Please purchase a new one.']);
                }
            $product = $licenseRecord->where('license_key', $licenseKey)->first();

            $category = Product::where('id', $product->product_id)->first()->category();
           
            // if ($category) {
                if ($telegramUserId) { 
                    $identifier = $telegramUserId;
                } elseif ($deviceIdentifier) { 
                 
                    $identifier = $deviceIdentifier;
                } else {
                    return response()->json(['success' => false, 'message' => 'Unknown product category.']);
                }

            // Save the device identifier or Telegram user ID in the record
                $licenseRecord->device_identifier = $identifier;
                $licenseRecord->update();

                return response()->json(['success' => true, 'message' => 'License verified and device identifier stored.']);
            // } else {
            //     return response()->json(['success' => false, 'message' => 'Product category not found.']);
            // }
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid license code.']);
        }
    }


    public function checkLicenseExpiration(Request $request)
    {
        // Assume that device_identifier is provided as an input in the request
        $deviceIdentifier = $request->input('device_identifier');

        // Find the license record based on the device identifier
        $licenseRecord = LicenseRecords::where('device_identifier', $deviceIdentifier)->first();

        if ($licenseRecord) {
            // Calculate the expiration date
            $licenseCreationDate = $licenseRecord->created_at;
            $licenseDurationMonths = $licenseRecord->license->type; // Duration in months
            $expirationDate = $licenseCreationDate->addMonths($licenseDurationMonths);

            // Check if the expiration date has passed
            if (now()->greaterThan($expirationDate)) {
                // Return a message indicating the license has expired
                return response()->json(['success' => false, 'message' => 'Your license has expired. Please purchase a new one.']);
            } else {
                // License is still valid
                return response()->json(['success' => true, 'message' => 'Your license is still valid.']);
            }
        } else {
            // License record not found
            return response()->json(['success' => false, 'message' => 'No valid license found for this device.']);
        }
    }

}
