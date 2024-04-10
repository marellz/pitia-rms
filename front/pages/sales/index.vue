<template>
  <layout-container>
    <layout-title>Sales</layout-title>

    <custom-table :items="items" :fields="fields">
        <template #amount="{amount}">
            <p>Ksh. {{  amount.toLocaleString() }}</p>
        </template>
        <template #status="{status}">
            <custom-tag :color="colorStatus(status)">
                {{ status }}
            </custom-tag>
           
        </template>
        <template #created_by="{created_by}">
            <div class="flex items-center space-x-2">
                <UserIcon class="h-4 text-gray-500" />
                <p>{{  created_by.name }}</p>
            </div>
        </template>
    </custom-table>

  </layout-container>
</template>
<script lang="ts" setup>
import { useSalesStore } from "~/store/sales";
import { UserIcon } from "@heroicons/vue/24/solid";
const store = useSalesStore();
const items = computed(() => store.items);
const fields = ref([
    { key: "created", label: "Created" },
    { key: "amount", label: "Amount" },
    { key: "status", label: "Status" },
    // todo: add payment detail if paid/complete
    { key: "created_by", label: "Created by" },
]);
onMounted(() => {
  store.all();
});

const colorStatus = (status: string) => {
    let color;
    switch (status) {
        case 'pending':
            color = 'bg-red-100 text-red-500'
            
            break;

        case 'paid':
            color = 'bg-amber-100 text-amber-600'
            
            break;
            
        case 'complete':
            color = 'bg-green-100 text-green-500'
            
            break;

    
        default:
            color = 'bg-gray-100 text-gray-600'
            break;
    }

    return color
}
</script>
