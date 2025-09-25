<x-agency.layout>
    @section('title')
       Client Details
    @endsection

    <style> 
      .card {
            width: 600px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: relative;
        }

        .background-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(45deg,
            rgba(128,128,128,0.05) 0px,
            rgba(128,128,128,0.05) 2px,
            transparent 2px,
            transparent 8px
            );
            z-index: 0;
        }

        .header {
            color: white;
            padding: 15px 0px;
            font-size: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        .headerTitle
        {
            background: #0066cc;
            color: white;
            padding: 15px 20px;
            font-size: 24px;
            border-bottom-right-radius: 50px;
            border-top-right-radius: 50px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .content {
            padding: 20px;
            display: flex;
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        .photo {
            width: 120px;
            height: 150px;
            background: #f0f0f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .details {
            flex: 1;
        }

        .field {
            margin-bottom: 15px;
        }

        .field-label {
            font-weight: bold;
            margin-right: 10px;
        }

        .barcode {
            margin-top: 20px;
            text-align: center;
        }

        .barcode img {
            height: 50px;
            width: 80%;
        }

        .id-number {
            color: #0066cc;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>

      <div class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">
              <a href="#"> 
            <div class="w-full h-32 border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 items-center justify-between p-4">
                <div class="flex flex-col gap-2">
                        <span class="font-semibold text-ternary/70 text-md">Paid Invoice </span>
                        <span class="font-bold text-2xl text-ternary">{{ $totalInvoicesCount ?? 0 }}</span>
                </div>

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" height="60" viewBox="0 0 876.27165 661.47277" xmlns:xlink="http://www.w3.org/1999/xlink" role="img" artist="Katerina Limpitsouni" source="https://undraw.co/">
                        <path d="M685.83423,138.6545c7.51624,15.99516-8.41069,20.5258-26.65516,29.099s-31.8977,17.94247-39.41393,1.94732-13.61474-47.74263,12.19523-59.87092C658.65953,97.2838,678.318,122.65934,685.83423,138.6545Z" transform="translate(-180.86417 -106.46046)" fill="#2f2e41"/>
                        <circle cx="467.74627" cy="39.08912" r="24.56103" fill="#ffb8b8"/>
                    </svg>
                </div>
            </div>
            </a>

            <div class="w-full h-32 border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 items-center justify-between p-4">
                <div class="flex flex-col gap-2">
                        <span class="font-semibold text-ternary/70 text-md">Total Invoice </span>
                        <span class="font-bold text-2xl text-ternary">{{ $totalInvoicesCount ?? 0 }}</span>
                </div>
            </div>

            <div class="w-full h-32 border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 items-center justify-between p-4">
                <div class="flex flex-col gap-2">
                        <span class="font-semibold text-ternary/70 text-md">Total Bookings </span>
                        <span class="font-bold text-2xl text-ternary">{{ $bookingCount ?? 0 }}</span>
                </div>
            </div>

            <div class="w-full h-32 border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 items-center justify-between p-4">
                <div class="flex flex-col gap-2">
                        <span class="font-semibold text-ternary/70 text-md">Signed Documents </span>
                        <span class="font-bold text-2xl text-ternary">{{ $paidInvoicesCount ?? 0 }}</span>
                </div>
            </div>
      </div>

        <div class="w-full bg-white rounded-lg shadow-lg p-6">
            <div class="w-full flex flex-wrap">

                <div data-tid="profileDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] bg-secondary/40 border-[2px] border-secondary/60 border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer">
                        Profile
                    </div>

                    <div data-tid="familyDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer">
                        Family Details
                    </div>

                    <div data-tid="invoiceDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer hidden">
                       Invoice
                    </div>

                    <div data-tid="docSignDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer">
                       DocSign
                    </div>

                </div>

                <div class="w-full mt-4">
                    <div id="docSignDiv" class="tab hidden">
                        <x-common.client.view-docsign :documents="$client->docsign" />
                    </div>

                    <div id="invoiceDiv" class="tab hidden">   
                        <x-common.client.client-invoice :invoices="$client->invoice" />
                    </div>

                    <div id="profileDiv" class="tab">
                        <x-common.client.profile-data :client="$client" />
                    </div>

                    <div id="familyDiv" class="tab hidden">
                        <x-common.client.family-members :client="$client" />
                    </div>

                </div>

            </div>
        </div>

        <script>
        jQuery(document).ready(function () {
            jQuery(document).on("click", ".agency_tab", function () {
                var id = jQuery(this).data('tid');
                
                if (id !== 'invoiceDiv') {
                    jQuery('[data-tid="invoiceDiv"]').addClass("hidden");
                }
                
                jQuery(".agency_tab").removeClass("bg-secondary/40 border-[2px] border-secondary/60");
                jQuery(this).addClass("bg-secondary/40 border-[2px] border-secondary/60");

                jQuery(".tab").hide();
                jQuery("#" + id).show();
            });
        });

        function showInvoiceTab() {
            jQuery('[data-tid="invoiceDiv"]').removeClass("hidden");
            jQuery(".agency_tab").removeClass("bg-secondary/40 border-[2px] border-secondary/60");
            jQuery('[data-tid="invoiceDiv"]').addClass("bg-secondary/40 border-[2px] border-secondary/60");
            jQuery(".tab").hide();
            jQuery("#invoiceDiv").show();
        }
        </script>

</x-agency.layout>