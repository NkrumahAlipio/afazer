<template>
    <div
        class="flex items-center justify-between p-4 mt-2 border-b rounded cursor-pointer select-none hover:bg-gray-100"
        @click="openTask"
        >
        <div class="flex items-center space-x-4">
            <input
                class="w-5 h-5 rounded-full"
                type="checkbox"
                v-model="task.done"
                @change="updateTask"
                @click.stop
            />
            <div class="flex flex-col">
                <h1
                    class="text-lg text-black"
                    :class="{ 'line-through': task.done }"
                    v-text="task.title"
                ></h1>
                <div class="flex items-center space-x-3 text-sm text-gray-700">
                    <h1>Tasks</h1>
                    <div class="w-1 h-1 bg-black rounded-full"></div>

                    <div class="flex items-center space-x-2 text-gray-500">
                        <DateText :date="task.date" :withIcon="true" :withColors="false" />
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-2">
            <ion-icon
                class="text-gray-400 hover:text-gray-600"
                name="trash-outline"
                @click.stop="deleteTask"
            ></ion-icon>
            <ion-icon
                class="text-gray-400 hover:text-gray-600"
                :name="task.favorite ? 'star' : 'star-outline'"
                @click.stop="
                    task.favorite = !task.favorite;
                    updateTask();
                "
            ></ion-icon>
        </div>
    </div>
</template>

<script>
import DateText from "../Partials/DateText.vue";
export default {
    props: ["task"],
    components: { DateText},
    methods: {
        updateTask() {
            this.$inertia.put("/tasks/" + this.task.id, this.task, {
                onSuccess: () =>
                    window.dispatchEvent(new CustomEvent("taskUpdated")),
            });
        },
        deleteTask() {
            this.$inertia.delete("/tasks/" + this.task.id, {
                onSuccess: () =>
                    window.dispatchEvent(new CustomEvent("taskDeleted")),
            });
        },
        openTask() {
            window.dispatchEvent(
                new CustomEvent("openTask", { detail: { task: this.task } })
            );
        },
    },
};
</script>
