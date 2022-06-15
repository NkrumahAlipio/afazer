<template>
    <Link
        :href="route('tasks', { description: href })"
        class="flex justify-between w-full px-6 py-3 hover:bg-white"
        :class="{ 'bg-gray-200': active }"
    >
        <div class="flex items-center space-x-4">
            <ion-icon :name="icon" style="font-size: 1.2rem"></ion-icon>
            <h1 class="text-base" v-text="text"></h1>
        </div>
        <h1 class="badge" v-if="tasks_count" v-text="tasks_count"></h1>
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    props: ["href", "text", "icon"],
    data() {
        return {
            tasks_count: null,
            active: window.location.href.includes(this.href),
        };
    },
    components: {
        Link,
    },

    created() {
        this.getTasksCount()
        window.addEventListener("taskCreated", () => this.getTasksCount());
        window.addEventListener("taskDeleted", () => this.getTasksCount());
        window.addEventListener("taskUpdated", () => this.getTasksCount());
    },

    methods: {
        getTasksCount() {
            window.axios.get("/task-count/" + this.href).then((res) => {
                this.tasks_count= res.data.tasks;
            });
        },
    },
};
</script>

<style>
</style>
