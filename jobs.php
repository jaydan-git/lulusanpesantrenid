<?php
header('Content-Type: application/json');

// Enable CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

// Sample job data (in a real application, this would come from a database)
$jobs = [
    ['id' => 1, 'title' => "Guru Bahasa Arab", 'company' => "Arabic Foundation", 'location' => "Jakarta", 'salary' => "Rp 3-5 juta", 'type' => "Full-time"],
    ['id' => 2, 'title' => "Translator", 'company' => "Translateaja!", 'location' => "Bandung", 'salary' => "Rp 8-10 juta", 'type' => "Full-time"],
    ['id' => 3, 'title' => "Konsultan Syariah", 'company' => "Consulting Group", 'location' => "Jakarta", 'salary' => "Rp 12-18 juta", 'type' => "Full-time"],
    ['id' => 4, 'title' => "Motivator Islami", 'company' => "Islamy Corp", 'location' => "Surabaya", 'salary' => "Rp 8-12 juta", 'type' => "Part-time"],
    ['id' => 5, 'title' => "Qari", 'company' => "Nahawand Group", 'location' => "Jakarta", 'salary' => "Rp 6-9 juta", 'type' => "Part-time"],
    ['id' => 6, 'title' => "Designer Busana Muslim", 'company' => "Innovation Boutique", 'location' => "Bandung", 'salary' => "Rp 4-6 juta", 'type' => "Online"],
    ['id' => 7, 'title' => "Pemandu Wisata Religi", 'company' => "Guide Solutions", 'location' => "Jakarta", 'salary' => "Rp 4-7 juta", 'type' => "Full-time"],
    ['id' => 8, 'title' => "Guru Tahsin dan Tahfidz", 'company' => "Abata Foundation", 'location' => "Surabaya", 'salary' => "Rp 3-4 juta", 'type' => "Part-time"],
    ['id' => 9, 'title' => "Penulis dan Editor Konten Islami", 'company' => "Nailul Project", 'location' => "Jakarta", 'salary' => "Rp 4-6 juta", 'type' => "Online"]
];

// Get filter parameters
$keyword = isset($_GET['keyword']) ? strtolower($_GET['keyword']) : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Filter jobs based on parameters
$filteredJobs = array_filter($jobs, function($job) use ($keyword, $location, $type) {
    $matchKeyword = empty($keyword) || 
                   stripos($job['title'], $keyword) !== false || 
                   stripos($job['company'], $keyword) !== false;
    
    $matchLocation = empty($location) || $job['location'] === $location;
    $matchType = empty($type) || $job['type'] === $type;
    
    return $matchKeyword && $matchLocation && $matchType;
});

// Return filtered jobs as JSON
echo json_encode(array_values($filteredJobs));
