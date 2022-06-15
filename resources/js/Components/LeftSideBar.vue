<template>
    <nav
        v-show="showing"
        class="
            bg-gray-100
            w-[20rem]
            text-black
            absolute
            lg:static
            z-50
            top-0
            bottom-0
            shadow
            lg:shadow-none
        "
    >
        <div class="flex items-center mx-6 my-5 space-x-2 text-gray-500">
            <ion-icon
                name="menu-outline"
                style="font-size: 1.5rem"
                class="rounded cursor-pointer hover:bg-white"
                @click="closeSideBar"
            ></ion-icon>
            <h1 class="text-lg font-bold">Menu</h1>
        </div>

        <SidebarItem icon="sunny-outline" text="My Day" href="today" />
        <SidebarItem icon="star-outline" text="Important" href="favorite" />
        <SidebarItem
            icon="calendar-number-outline"
            text="Planned"
            href="planned"
        />
        <SidebarItem icon="checkmark-outline" text="Completed" href="done" />
        <SidebarItem icon="play-back-outline" text="Overdue" href="overdue" />
    </nav>
</template>

<script>
import SidebarItem from "../Partials/SidebarItem.vue";
export default {
    data() {
        return {
            showing: window.showingSideBar,
        };
    },
    mounted() {
        window.addEventListener("openingSideBar", () => {
            this.showing = window.showingSideBar;
        });
    },
    components: {
        SidebarItem,
    },
    methods: {
        closeSideBar() {
            this.showing = false;
            window.showingSideBar = false;
            window.dispatchEvent(new CustomEvent("closingSideBar"));
        },
    },
};
</script>
