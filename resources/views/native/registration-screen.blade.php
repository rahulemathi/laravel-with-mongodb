<native:refreshable @refresh="refresh">

    <native:column class="w-full gap-5 p-6 items-center justify-center">
        {{-- logo --}}
        <native:column class="w-[80] h-[80] rounded-2xl bg-violet-600 items-center justify-center"> 
               <native:text class="text-3xl font-bold text-white text-center">
                    Chat App
                </native:text>
        </native:column>
    </native:column>
    
    {{-- heading --}}
    <native:column class="w-full gap-5 pt-3 px-4">

        <native:outlined-text-input 
        label="Name" 
        placeholder="Enter your name" 
        keyboard="text" 
        native:model="name"
        :error="$nameError !== ''"
        :supporting="$nameError"
        leading-icon="person">
        </native:outlined-text-input>

         <native:outlined-text-input 
        label="email" 
        placeholder="Enter your email" 
        keyboard="email" 
        native:model="email"
        :error="$emailError !== ''"
        :supporting="$emailError"
        leading-icon="mail">
        </native:outlined-text-input>

         <native:outlined-text-input 
        label="password" 
        placeholder="Enter your password" 
        keyboard="text" 
        native:model="password"
        :error="$passwordError !== ''"
        :supporting="$passwordError"
        leading-icon="lock"
        secure="true">
        </native:outlined-text-input>

        <native:outlined-text-input 
        label="Confirm Password" 
        placeholder="Confirm your password" 
        keyboard="text" 
        native:model.live="confirmPassword"
        :error="$confirmPasswordError !== ''"
        :supporting="$confirmPasswordError"
        leading-icon="lock"
        secure="true">
        </native:outlined-text-input>

        <native:button class="w-full" label="register" variant="primary" @press="register" /> 
    </native:column>

</native:refreshable>