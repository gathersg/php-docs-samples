<?php
/*
 * Copyright 2020 Google LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

// [START kms_update_key_remove_rotation_schedule]
use Google\Cloud\Kms\V1\CryptoKey;
use Google\Cloud\Kms\V1\KeyManagementServiceClient;
use Google\Protobuf\FieldMask;

function update_key_remove_rotation_sample(
  $projectId = 'my-project',
  $locationId = 'us-east1',
  $keyRingId = 'my-key-ring',
  $keyId = 'my-key'
) {
    // Create the Cloud KMS client.
    $client = new KeyManagementServiceClient();

    // Build the key name.
    $keyName = $client->cryptoKeyName($projectId, $locationId, $keyRingId, $keyId);

    // Build the key.
    $key = (new CryptoKey())
        ->setName($keyName);

    // Create the field mask.
    $updateMask = (new FieldMask())
        ->setPaths(['rotation_period', 'next_rotation_time']);

    // Call the API.
    $updatedKey = $client->updateCryptoKey($key, $updateMask);
    printf('Updated key: %s' . PHP_EOL, $updatedKey->getName());
    return $updatedKey;
}
// [END kms_update_key_remove_rotation_schedule]

if (isset($argv)) {
    require_once __DIR__ . '/../vendor/autoload.php';
    list($_, $projectId, $locationId, $keyRingId, $keyId) = $argv;
    update_key_remove_rotation_sample($projectId, $locationId, $keyRingId, $keyId);
}