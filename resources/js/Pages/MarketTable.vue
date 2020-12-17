<template>
  <table class="table-auto w-full divide-y divide-gray-200 mt-4">
    <thead class="bg-gray-50">
      <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Reference Number
        </th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Product Name
        </th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Price
        </th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Quantity
        </th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Actions
        </th>
      </tr>
    </thead>

    <tbody class="bg-white divide-y divide-gray-200">
      <tr v-if="data.length == 0">
        <td
          class="px-6 py-3 text-center text-md font-bold text-black tracking-wider"
          colspan="5"
        >
          No Products Found
        </td>
      </tr>

      <tr
        v-else
        v-for="data in data"
        :key="data.id"
      >
        <td class="px-6 py-3 text-left text-md font-bold text-black tracking-wider">
          {{ data.reference_number }}
        </td>
        <td class="px-6 py-3 text-left text-md font-bold text-black tracking-wider">
          {{ data.name }}
        </td>
        <td class="px-6 py-3 text-left text-md font-bold text-black tracking-wider">
          ${{ data.price }}
        </td>
        <td class="px-6 py-3 text-left text-md font-bold text-black tracking-wider">
          {{ data.quantity }} pcs
        </td>
        <td class="px-6 py-3 text-left text-md font-bold text-black tracking-wider">
          <jet-button @click.native="initEdit(data)">Edit</jet-button>

          <jet-danger-button @click.native="initDelete({'id': data.id, 'name': data.name})">Delete</jet-danger-button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import JetButton from '@/Jetstream/Button';
import JetDangerButton from '@/Jetstream/DangerButton';

export default {
  components: {
    JetButton,
    JetDangerButton,
  },

  props: {
    data: {
      type: Array,
      required: true,
    },
  },

  methods: {
    initEdit(data) {
      this.$emit('initEdit', data);
    },

    initDelete(data) {
      this.$emit('initDelete', data);
    },
  },
};
</script>
