<native:column class="w-full h-full bg-gray-50 dark:bg-gray-950">

    {{-- Header --}}
    <native:row class="items-center px-4 py-3 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800">

        <native:button
            wire:click="replace('/mobile/users')"
            class="w-10 h-10 items-center justify-center"
        >
            <native:icon name="arrow-left" />
        </native:button>

        <native:column class="ml-3 gap-0">
            <native:text class="text-lg font-bold dark:text-white">
                {{ $user->name }}
            </native:text>

            <native:text class="text-xs text-gray-500">
                {{ $user->is_online ? 'Online' : 'Offline' }}
            </native:text>
        </native:column>

    </native:row>


    {{-- Messages --}}
    <native:scroll-view class="flex-1 px-4 py-4">

        <native:column class="gap-3">

            @foreach ($messages as $msg)

                @if ($msg->sender_id === Auth::id())

                    {{-- Sent --}}
                    <native:row class="justify-end">

                        <native:column class="max-w-[80%] items-end">

                            <native:column class="bg-blue-500 rounded-2xl rounded-br-md px-4 py-3">

                                <native:text class="text-white">
                                    {{ $msg->message }}
                                </native:text>

                            </native:column>

                            <native:text class="text-xs text-gray-400 mt-1">
                                {{ $msg->created_at->format('h:i A') }}
                            </native:text>

                        </native:column>

                    </native:row>

                @else

                    {{-- Received --}}
                    <native:row class="justify-start">

                        <native:column class="max-w-[80%]">

                            <native:column class="bg-white dark:bg-gray-900 rounded-2xl rounded-bl-md px-4 py-3 shadow-sm">

                                <native:text class="text-gray-900 dark:text-white">
                                    {{ $msg->message }}
                                </native:text>

                            </native:column>

                            <native:text class="text-xs text-gray-400 mt-1">
                                {{ $msg->created_at->format('h:i A') }}
                            </native:text>

                        </native:column>

                    </native:row>

                @endif

            @endforeach

        </native:column>

    </native:scroll-view>


    {{-- Message Input --}}
    <native:row class="items-center gap-2 px-4 py-3 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">

        <native:outlined-text-input
            label="Message"
            native:model="message"
            class="flex-1"
        />

        <native:button
            wire:click="sendMessage"
            class="w-12 h-12 rounded-full bg-blue-500 items-center justify-center"
        >
            <native:icon name="paper-airplane" />
        </native:button>

    </native:row>

</native:column>