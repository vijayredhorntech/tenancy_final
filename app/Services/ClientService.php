<?php

namespace App\Services;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use App\Services\AgencyService;
use App\Repositories\Interfaces\ClintRepositoryInterface;

use App\Services\FileUploadService;


class ClientService
{
    protected $fileUploadService,$agencyService,$visaRepository,$clientService;

    public function __construct(FileUploadService $fileUploadService,AgencyService $agencyService,ClientService $clientService)
    {
        $this->clientService = $clientService;
        $this->visaRepository = $visaRepository;
        $this->fileUploadService = $fileUploadService;
        $this->agencyService = $agencyService;
    }


    public function storeClient($data){
        dd("hello");
    }
    // Add other methods related to client business logic here
}
