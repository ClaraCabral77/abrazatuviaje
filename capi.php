<?php
// 🔹 Datos de Facebook
$access_token = "EAAJlmrEAxLoBPDo08hcnuUPOe6b8Fg07K3DEGDwVrD5yKW3Kjz9HVHaFZBgZBtSCqwzc5ZCh0DdgwK9WzbhYl8M5sNZB4Vw7qQv3aqSrZAsPnrOFpyIBIQSgPANA7SZCJZCPoKZBSkQqK61xaB1gF3Mt7wJOsimadeduZAGqxLoVkPa8G4o6ab0a12EcMcGt7NQZDZD"; // el que ya generaste
$pixel_id = "1792427424644240"; // el número de tu pixel

// Endpoint de la API
$url = "https://graph.facebook.com/v20.0/$pixel_id/events?access_token=$access_token";

// 🔹 Evento de ejemplo (Compra por 1000 ARS)
$data = [
    "data" => [
        [
            "event_name" => "Purchase",      // Tipo de evento (puede ser PageView, Lead, etc.)
            "event_time" => time(),          // Momento del evento
            "action_source" => "website",    // Indica que viene de la web
            "event_source_url" => "https://tusitio.com/checkout", // URL donde pasó
            "user_data" => [
                // Los datos personales se mandan encriptados (hash SHA256)
                "em" => [hash("sha256", "cliente@email.com")],
                "ph" => [hash("sha256", "5491123456789")]
            ],
            "custom_data" => [
                "currency" => "ARS",
                "value" => 1000.00
            ]
        ]
    ],
   
];

// 🔹 Inicializar cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
curl_close($ch);

// Ver respuesta
echo $response;
