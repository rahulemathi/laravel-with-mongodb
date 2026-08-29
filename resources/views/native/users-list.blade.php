<native:refreshable @refresh="refresh">
    <native:column class="w-full gap-5 pt-3 px-4">
        <native:text class="text-xl font-bold text-center dark:text-white">
            Log in
        </native:text>
        <native:column class="flex items-center gap-3 bg-white rounded-2xl px-4 py-3 shadow-sm">
            <native:outlined-text-input label="search" native:model.debounce.500ms="search"
                leading-icon="search"></native:outlined-text-input>

            @if ($showSearchResults)
                @foreach ($search_users as $user)
                    <native:pressable  class="items-center gap-4 px-10 py-4 shadow-sm flex-row w-full mx-4 rounded-xl">
                        <native:column class="w-14 h-14 rounded-full flex items-center justify-center overflow-hidden">
                            <native:image src="https://i.pravatar.cc/150?img=12" :width="200"
                                :height="150" :fit="2" class="rounded-xl"></native:image>
                        </native:column>
                        <native:column class="">
                            <native:text>
                                {{ $user->name }}
                            </native:text>
                            <native:text class="text-sm text-green-600 mt-0.5">
                                {{ $user->is_online ? 'Online' : 'Offline' }}
                            </native:text>
                        </native:column>
                    </native:pressable>
                @endforeach
            @endif
        </native:column>

        @foreach ($users as $user)
            <native:column class="items-center gap-4 px-10 py-4 shadow-sm flex-row w-full mx-4 rounded-xl">
                <native:column class="w-14 h-14 rounded-full flex items-center justify-center overflow-hidden">
                    <native:image src="https://i.pravatar.cc/150?img=12" :width="200" :height="150"
                        :fit="2" class="rounded-xl"></native:image>
                </native:column>
                <native:column class="">
                    <native:text>
                        {{ $user->name }}
                    </native:text>
                    <native:text class="text-sm text-green-600 mt-0.5">
                        {{ $user->is_online ? 'Online' : 'Offline' }}
                    </native:text>
                </native:column>
            </native:column>
        @endforeach
    </native:column>
</native:refreshable>
