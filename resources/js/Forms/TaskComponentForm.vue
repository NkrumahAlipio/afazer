<template>
    <form
        @submit.prevent="updateTask"
        class="flex items-center space-x-4 rounded cursor-pointer select-none"
    >
        <input
            class="w-5 h-5 rounded-full"
            type="checkbox"
            v-model="task.done"
            @change="updateTask"
        />
        <input
            class="w-full h-8 px-1 rounded-sm"
            :class="{ 'line-through': task.done }"
            v-model="task.title"
        />
        <ion-icon
            style="font-size: 1.2rem"
            class="text-gray-400 hover:text-gray-600"
            :name="task.favorite ? 'star' : 'star-outline'"
            @click="
                task.favorite = !task.favorite;
                updateTask();
            "
        ></ion-icon>
    </form>
</template>

<script>
export default {
    props: ["task"],
    methods: {
        updateTask() {
            this.$inertia.put("/tasks/" + this.task.id, this.task, {
                onSuccess: () =>
                    window.dispatchEvent(new CustomEvent("taskUpdated")),
            });
        },
    },
};
</script>

<style>
</style>
