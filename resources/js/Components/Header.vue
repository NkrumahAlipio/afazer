<template>
    <nav
        class="flex items-center justify-between w-full h-16 px-6 text-white lg:px-8 bg-primary"
    >
        <Link :href="route('home')">
            <JetApplicationLogo class="w-40" />
        </Link>
        <JetDropdown>
            <template #trigger>
                <div class="avatar">
                    <div class="w-10 rounded-full">
                        <img
                            :src="$page.props.user.profile_photo_url"
                        />
                    </div>
                </div>
            </template>
            <template #content>
                <JetDropdownLink as="a" :href="route('profile.show')">
                    Profile
                </JetDropdownLink>
                <form @submit.prevent="logout">
                    <JetDropdownLink as="button">Logout</JetDropdownLink
                    >
                </form>
            </template>
        </JetDropdown>
    </nav>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import JetApplicationLogo from "@/Jetstream/ApplicationLogo";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
export default {
    methods:{
        logout(){
            Inertia.post(route("logout"));
        }
    },
   components:{
        Link,
        JetApplicationLogo,
        JetDropdown,
        JetDropdownLink
   }
}
</script>


