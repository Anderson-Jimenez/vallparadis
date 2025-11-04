<aside class="bg-[#2D3E50] p-8 h-[45vw] flex flex-col justify-between w-1/5">
                    <ul>
                        <li class="group my-4 rounded-lg transition-all duration-300">
                            <a href="{{ route('center.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300 ">
                            
                                <svg class="w-8 h-8 text-white">
                                    <use xlink:href="#professional_icon"></use>
                                </svg>

                                <span class="text-white text-lg">
                                    Gestió Centre
                                </span>
                            </a>
                        </li>
                        <li class="group my-4 rounded-lg transition-all duration-300">
                            <a href="{{ route('professional.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300">
                            
                                <svg class="w-8 h-8 text-white">
                                    <use xlink:href="#center_icon"></use>
                                </svg>

                                <span class="text-white text-lg">
                                    Gestió Professionals
                                </span>
                            </a>
                        </li>
                        <li class="group my-4 rounded-lg transition-all duration-300">
                            <a href="{{ route('project_comission.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300">
                            
                                <svg class="w-10 h-10 text-white">
                                    <use xlink:href="#project_icon"></use>
                                </svg>

                                <span class="text-white text-lg">
                                    Gestió Projectes i comissions
                                </span>
                            </a>
                        </li>
                        <li class="group my-4 rounded-lg transition-all duration-300">
                            <a href="{{ route('course.index') }}" class="flex items-center gap-3 p-4 rounded-lg bg-[#2D3E50] group-hover:bg-[#ff7300] transition-all duration-300">
                            
                                <svg class="w-10 h-10 text-white">
                                    <use xlink:href="#courses_icon"></use>
                                </svg>

                                <span class="text-white text-lg">
                                    Gestió de Cursos
                                </span>
                            </a>
                        </li>
                    </ul>   
                    <a href="{{ route('logout') }}" class="group flex justify-center items-center top-20 w-[15vw] h-[3vw] bg-white text-[#ff7300] px-3 py-1 rounded-full text-lg font-semibold
                    transition-all duration-300 hover:bg-[#ff7300] hover:text-white">
                        Tancar sessió
                    </a>
                </aside>