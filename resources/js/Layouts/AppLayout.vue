<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import Header from "@/Components/Header";
import LeftSideBar from "@/Components/LeftSideBar";
import RightSideBar from "@/Components/RightSideBar";
import JetBanner from "@/Jetstream/Banner";

defineProps({
    title: String,
});
</script>

<template>
    <div>
        <Head :title="title" />

        <JetBanner />

        <div class="flex flex-col min-h-screen bg-gray-100">
            <Header />
            <div class="relative flex flex-1" id="content">
                <LeftSideBar />
                <slot />
                <RightSideBar />
            </div>
        </div>
    </div>
</template>
