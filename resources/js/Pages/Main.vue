<template>
    <AppLayout title="Nada" :tasks="tasks">
        <main class="flex-1 bg-white" @open-task="openTask">
            <div class="px-6 py-8 lg:px-10">
                <div class="flex items-center space-x-4 text-black">
                    <ion-icon
                        name="menu-outline"
                        style="font-size: 1.5rem"
                        class="rounded cursor-pointer hover:bg-white"
                        v-show="!showing"
                        @click="openSideBar"
                    ></ion-icon>
                    <h1
                        class="text-2xl font-bold capitalize text-primary"
                        v-text="title"
                    ></h1>
                </div>
                <TaskForm />
                <template v-for="task in tasks" :key="'task-' + task.id">
                    <Task :task="task" />
                </template>
            </div>
        </main>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import TaskForm from "../Forms/TaskForm.vue";
import Task from "../Components/Task.vue";

export default {
    props: ["tasks", "title"],
    components: {
        AppLayout,
        TaskForm,
        Task,
    },
    mounted() {
        window.addEventListener(
            "closingSideBar",
            () => (this.showing = window.showingSideBar)
        );
    },
    data() {
        return {
            showing: window.showingSideBar,
            side_task: null,
        };
    },
    methods: {
        openSideBar() {
            this.showing = true;
            window.showingSideBar = true;
            window.dispatchEvent(new CustomEvent("openingSideBar"));
        },
    },
};
</script>


