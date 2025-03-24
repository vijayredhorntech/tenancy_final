<x-agency.layout>
    @section('title') Visa View @endsection

    <style>
<style>
    .visa-container {
        width: 100%;
        max-width: 1100px;
        margin: auto;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-top: 4px solid #007bff;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 8px;
    }

    .visa-header {
        background-color: rgba(0, 123, 255, 0.1);
        padding: 12px 20px;
        border-bottom: 2px solid rgba(0, 123, 255, 0.2);
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
    }

    .visa-form-container {
        text-align: center;
        margin-top: 20px;
    }

    .visa-title {
        font-size: 2rem;
        font-weight: 700;
        color: black;
    }

    .visa-subtitle {
        font-size: 1.1rem;
        font-weight: 500;
        margin-top: 8px;
        color: #666;
        max-width: 800px;
        margin: auto;
    }

    .visa-form {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }

    .visa-select {
        width: 250px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid rgba(0, 123, 255, 0.4);
        transition: border-color 0.2s ease-in-out;
        font-size: 1rem;
    }

    .visa-select:focus {
        outline: none;
        border-color: rgba(0, 123, 255, 0.7);
    }

    .visa-button {
        background-color: #007bff;
        padding: 12px 20px;
        color: white;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease-in-out;
        font-size: 1rem;
        border: none;
    }

    .visa-button:hover {
        background-color: #0056b3;
    }

    .help-section {
        display: flex;
        justify-content: center;
        background-color: #333;
        padding: 10px 20px;
        color: white;
        font-weight: 600;
        border-radius: 5px;
        margin-top: 25px;
    }

    .help-link {
        margin-right: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    .help-link i {
        font-size: 1.2rem;
    }
</style>

    </style>

    <div class="visa-container">
        <!-- Header -->
        <div class="visa-header">
            <span class="visa-heading">Assign Country</span>
        </div>

        <!-- Visa Form Section -->
        <section class="2xl:px-64 xl:px-52 lg:px-24 md:px-5 sm:px-5 px-5">
            <div class="visa-form-container">
                <span class="visa-title">Travel Visa Requirements</span>
                <span class="visa-subtitle">Sometimes a journey of a thousand miles begins with a visa. Check your destination and apply online for any visa in the world.</span>
               
                <form action="{{ route('searchvisa') }}" method="POST" enctype="multipart/form-data" class="visa-form">
                  @csrf
         
                    <div class="flex w-full">
                        <div class="w-1/3 flex flex-col mt-5">
                            <select name="origincountry" id="origincountry" class="visa-select">
                                <option value="">---Select---</option>
                                @forelse($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @empty
                                    <option value="">No record found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="w-1/3 flex flex-col mt-5">
                            <select name="destinationcountry" id="destinationcountry" class="visa-select">
                                <option value="">---Select---</option>
                                @forelse($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @empty
                                    <option value="">No record found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="w-1/3 flex flex-col mt-5">
                            <button class="visa-button">Check <span class="hidden 2xl:inline-block xl:inline-block lg:inline-block md:inline-block sm:inline-block">Requirements</span></button>
                        </div>
                    </div>
                </form>

                <div class="help-section">
                    <span class="help-link"><i class="fa-brands fa-rocketchat"></i> Chat with us</span>
                    <span class="help-link"><i class="fa-solid fa-phone"></i> Call +91 987654321</span>
                </div>
            </div>
        </section>
    </div>
</x-agency.layout>
