<x-front.layout>
    @section('title') Visa Application @endsection



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


        .container { width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        .header { text-align: center; font-size: 20px; font-weight: bold; }
        .details { margin-top: 20px; }
        .details table { width: 100%; border-collapse: collapse; }
        .details th, .details td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; }
    </style>


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl"></span>
            <span class="font-semibold text-ternary text-xl">
             Visa : {{ $visa->name ?? 'N/A' }} 
                

</span>

            <span class="font-semibold text-ternary text-xl"></span>

            
        </div>

        


        <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex flex-wrap ">

                <div data-tid="VisaDeatilsDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] bg-secondary/40 border-[2px] border-secondary/60 border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-eye text-ternary"></i>
                       Visa Details
                </div>

                
               <div data-tid="editDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fa fa-pencil text-ternary"></i>
                    Edit
                </div>

                <div  class="w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <a href="{{ route('visa.assign', ['id' => $visa->id]) }}">
                        <i class="fa fa-clipboard-check text-ternary"></i>
                                    Assign Country
                    </a>
                </div>


              </div>

                <div class="w-full mt-4 ">
            <!-- start joing letter  -->

           
                <!-- view application  -->
                <div id="VisaDeatilsDiv" class="tab  ">
                    <x-visa.viewdetails :visa="$visa" />
  
                </div>

                <!-- end applicatoin  -->

                <div id="editDiv" class="tab hidden">
                    <x-visa.editvisa :visa="$visa" :eid="$visa->id" />             
                </div>

      <!-- end joing letter  -->
                  {{--  <div id="assignCountrDiv" class="tab  hidden">
                        <x-visa.assigncountry :visa="$visa"/> 
                    </div>
--}}
         
              
                <!-- here -->
                    </div>

                </div>

            </div>
        </div>

        <script>
        jQuery(document).ready(function () {
            jQuery(document).on("click", ".agency_tab", function () {
                                var id = jQuery(this).data('tid');
                                  jQuery(".agency_tab").removeClass("bg-secondary/40 border-[2px] border-secondary/60");
                                jQuery(this).addClass("bg-secondary/40 border-[2px] border-secondary/60");

                                // Hide all tabs and show the selected one
                                jQuery(".tab").hide();
                                jQuery("#" + id).show();
                            });
                });

        </script>

        </x-front.layout>
