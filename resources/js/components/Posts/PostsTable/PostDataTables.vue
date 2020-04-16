<template>
  <div>
    <h1>Post Table</h1>

    <div class="row">
      <div class="col">
        <div class="form-inline">
          <div class="form-group">
            <label>Show &nbsp;</label>
            <select
              v-model="perPage"
              @change="onChangePerPage()"
              class="form-control form-control-sm"
            >
              <option
                v-for="(perPage, index) in perPageOption"
                :key="index"
                :value="perPage"
              >{{perPage}}</option>
            </select>
            <!-- <input class="form-control" v-model="perPage" /> -->
            <label>&nbsp; entries</label>
          </div>
        </div>
      </div>
      <div class="col">
        <filter-bar class="pull-right" @filterText="onFilterSet"></filter-bar>
      </div>
    </div>

    <div class="table-responsive-sm">
      <vuetable
        ref="vuetable"
        api-url="http://git-project.test/ptables"
        :fields="fields"
        data-path="data"
        pagination-path
        :css="css.table"
        :append-params="moreParams"
        :per-page="perPage"
        @vuetable:pagination-data="onPaginationData"
      ></vuetable>
    </div>

    <div class="row" style="margin-top:5px;">
      <div class="col">
        <vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>
      </div>
      <div class="col">
        <vuetable-pagination
          ref="pagination"
          class="pull-right"
          :css="css.pagination"
          @vuetable-pagination:change-page="onChangePage"
        ></vuetable-pagination>
      </div>
    </div>
    <!-- <posts-update></posts-update> -->
    <posts-update :updateData="postData"></posts-update>
    <posts-delete :post="postData"></posts-delete>
  </div>
</template>

<script>
import Vue from "vue";
import Vuetable from "vuetable-2";
import CssForBootstrap4 from "./VuetableCssBootstrap4.js";
// import VuetablePagination from "vuetable-2/src/components/VuetablePagination";
import VuetablePagination from "./VuetablePaginationBootstrap4.vue";
import VuetablePaginationInfo from "vuetable-2/src/components/VuetablePaginationInfo";
import FilterBar from "./FilterBar";
import FieldsDef from "./FieldsDef.js";

// import VueEvents from "vue-events";
// Vue.use(VueEvents);

export default {
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
    FilterBar

    // CustomActions
  },
  data() {
    return {
      postData: {},
      perPageOption: [1, 5, 10, 50, 100],
      perPage: 10,
      moreParams: {},
      css: CssForBootstrap4,
      fields: FieldsDef
    };
  },
  mounted() {
    this.$events.listen("show-update-modal", data =>
      this.showUpdateModal(data)
    );
    this.$events.listen("show-delete-modal", data =>
      this.showDeleteModal(data)
    );
    Echo.channel("PostChannel").listen("PostEvent", data => {
      this.refreshVueTable();
    });
    //this.$events.listen("refreshVueTable", data => this.refreshVueTable());
  },

  methods: {
    showUpdateModal(data) {
      this.postData = data;
    },

    showDeleteModal(data) {
      this.postData = data;
    },

    refreshVueTable() {
      this.$refs.vuetable.refresh();
    },

    onChangePerPage() {
      this.perPage = this.perPage;
      // console.log(this.perPage);
    },
    onPaginationData(paginationData) {
      this.$refs.pagination.setPaginationData(paginationData);
      this.$refs.paginationInfo.setPaginationData(paginationData);
    },

    onChangePage(page) {
      this.$refs.vuetable.changePage(page);
    },
    onFilterSet(filterText) {
      console.log(filterText);
      this.moreParams = {
        filter: filterText
      };
      Vue.nextTick(() => this.$refs.vuetable.refresh());
    }
  }
};
</script>