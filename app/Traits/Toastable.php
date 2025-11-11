<?php
namespace App\Traits;

trait Toastable
{
    public function success(string $message)
    {
 

            session()->flash('toast', ['type' => 'success', 'message' => $message]);
  
    }

    public function error(string $message)
    {
     
            session()->flash('toast', ['type' => 'error', 'message' => $message]);
    
    }

    public function info(string $message)
    {
      
            session()->flash('toast', ['type' => 'info', 'message' => $message]);

    }
}
