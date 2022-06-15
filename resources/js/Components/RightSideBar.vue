<template >
    <div
        v-if="showing"
        class="
            bg-gray-100
            w-full
            md:w-[24rem]
            text-black
            absolute
            lg:static
            z-50
            top-0
            bottom-0
            shadow
            lg:shadow-none
            right-0
        "
    >
        <div class="flex flex-col px-8 lg:px-0">
            <div
                class="flex justify-end p-3 space-x-2 text-gray-600 cursor-pointer "
            >
                <h1
                    class="text-base"
                    @click="
                        showing = false;
                    "
                >
                    Close
                </h1>
                <ion-icon
                    name="close-outline"
                    style="font-size: 1.5rem"
                ></ion-icon>
            </div>
            <div class="p-2">
                <Card>
                    <TaskComponentForm :task="task" />
                </Card>
            </div>
            <div class="p-2 cursor-pointer">
                <Card>
                    <DateDropdown :form="task">
                        <DateText
                            :date="task.date"
                            :withColors="true"
                            :withIcon="true"
                        />
                    </DateDropdown>
                </Card>
            </div>
            <div class="p-2"></div>
            <div class="p-2"></div>
        </div>
    </div>
</template>

<script>
import Card from "../Partials/Card.vue";
import TaskComponentForm from "../Forms/TaskComponentForm.vue";
import DateText from "../Partials/DateText.vue";
import DateDropdown from "../Partials/DateDropdown.vue";
export default {
    data() {
        return {
            task: null,
            showing: false
        };
    },
    created() {
        window.addEventListener("openTask", (e) => {
            this.task = e.detail.task;
            this.showing = true;
        });
    },
    watch: {
        'task.date'() {
            this.$inertia.put("/tasks/" + this.task.id, this.task, {
                onSuccess: () =>
                    window.dispatchEvent(new CustomEvent("taskUpdated")),
            });
        },
    },
    components: { Card, TaskComponentForm, DateText, DateDropdown },
};
</script>

<style>
</style>
