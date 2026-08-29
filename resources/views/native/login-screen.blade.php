<native:refreshable @refresh="refresh">
    <native:column class="w-full gap-5 p-6 items-center justify-center">
        <native:column class="w-[80] h-[80] rounded-2xl bg-violet-600 items-center justify-center">
            <native:text class="text-3xl font-bold text-white text-center">
                Chat App
            </native:text>
        </native:column>

        <native:text class="text-xl font-bold text-center dark:text-white">
            Log in
        </native:text>
    </native:column>

    <native:column class="w-full gap-5 pt-3 px-4">
        <native:outlined-text-input
            label="Email"
            placeholder="Enter your email"
            keyboard="email"
            native:model="email"
            :error="$emailError !== ''"
            :supporting="$emailError"
            leading-icon="mail">
        </native:outlined-text-input>

        <native:outlined-text-input
            label="Password"
            placeholder="Enter your password"
            keyboard="text"
            native:model="password"
            :error="$passwordError !== ''"
            :supporting="$passwordError"
            leading-icon="lock"
            secure="true">
        </native:outlined-text-input>

        <native:text class="text-center text-red-600">
            {{ $loginError }}
        </native:text>

        <native:button class="w-full" label="Log in" variant="primary" @press="login" />
        <native:button class="w-full" label="Create account" variant="secondary" @press="showRegistration" />
        
    </native:column>
</native:refreshable>
