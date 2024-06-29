    <!-- Main modal -->
    <div id="modal-qr" data-modal-target="modal-qr" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-max max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        QR invitado
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-qr">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="flex w-[650px] h-[400px]" id="qr-card">
                        <div class="bg-[url('../../images/boda_background_qr.png')] bg-[length:100%_100%] bg-no-repeat !w-full h-full bg-center pt-[4.5rem] px-8 flex items-center" id="qr-card">
                            <div id="qr-image" class="basis-4/12">QR Image</div>
                            <div class="basis-8/12 text-center">
                                <p class="text-center font-Cinzel text-xl font-semibold">Nuestra Boda</p>
                                <div class="flex font-GreatVibes items-center gap-2 justify-center">
                                    <span class="text-[38px] font-medium text-[#D96C75]">Samanta</span>
                                    <span>
                                        <img src="{{ asset('images/services2-1.png') }}" alt="heart" class="w-11">
                                    </span>
                                    <span class="text-[38px] font-medium text-[#D96C75]">Eduardo</span>
                                </div>
                                <p class="text-center font-Cinzel text-sm font-semibold">
                                    <span id="invitado">-Invitado-</span>, ACOMPAÑENNOS A CELEBRAR NUESTRA UNIÓN
                                </p>
                                <div class="flex mx-auto justify-center">
                                    <table class="center fecha" border="0">
                                        <tr>
                                            <td class="font-Cinzel nombre-semana text-center">Sábado</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <div class="flex justify-center items-center py-2 relative">
                                                    <span class="font-Cinzel mes px-[10px] font-semibold text-xl"> -- </span>
                                                    <span class="font-Cinzel dia px-[10px] pb-3 border-l-2 border-r-2 border-[#6D6E60] font-semibold text-4xl !leading-normal align-middle"> -- </span>
                                                    <span class="font-Cinzel anio px-[10px] font-semibold text-xl"> -- </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="gral-text text-center lugar font-Cinzel pt-1 font-semibold text-sm">
                                                <p class="hora-boda">3:30 PM</p>
                                                <p class="lugar-boda">Jiutepec, Morelos.</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div id="muestra"></div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button" id="descargar" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Descargar</button>
                    <button data-modal-hide="modal-qr" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
