<template>
  <th v-if="isHeader" class="vuetable-th-component-buttons" v-html="title"></th>
  <td v-else class="vuetable-td-component-buttons">
    <button
      class="btn btn-info btn-sm"
      @click="editAction(rowData, rowIndex) "
      data-toggle="modal"
      data-target="#updatePostModal"
    >
      <i class="fa fa-edit"></i>
    </button>
    <button
      class="btn btn-danger btn-sm"
      @click="deleteAction( rowData, rowIndex)"
      data-toggle="modal"
      data-target="#deletePostModal"
    >
      <i class="fa fa-trash"></i>
    </button>
  </td>
</template>
<script>
import $ from "jquery";
import VuetableFieldMixin from "vuetable-2/src/components/VuetableFieldMixin.vue";
// import VueEvents from "vue-events";
// Vue.use(VueEvents);

export default {
  name: "vuetable-field-buttons",
  mixins: [VuetableFieldMixin],

  methods: {
    editAction(data, index) {
      // console.log(data, index);
      let dataToUpdate = { ...data };
      this.$events.fire("show-update-modal", dataToUpdate);
    },
    deleteAction(data, index) {
      console.log(data, index);

      let dataToDelete = { ...data };
      this.$events.fire("show-delete-modal", dataToDelete);
    }
  }
};
</script>