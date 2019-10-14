<template>
  <div class="filter-bar">
    <div class="form-inline">
      <div class="form-group">
        <label>
          Search: &nbsp;
          <input
            type="text"
            v-model="filterText"
            class="form-control form-control-sm"
            @keyup="doFilter"
          />
          <!-- placeholder="name, nickname, or email" -->
        </label>

        <!-- <button class="btn btn-primary btn-sm" @click="doFilter">Go</button>
        <button class="btn btn-secondary btn-sm" @click="resetFilter">Reset</button>-->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      filterText: ""
    };
  },

  methods: {
    doFilter() {
      this.$emit("filterText", this.filterText);
    }
    // resetFilter() {
    //   this.filterText = "";
    //   this.$emit("onFilterReset");
    // }
  }
};
</script>
<style>
.filter-bar {
  margin-bottom: 8px;
  box-sizing: border-box;
}
</style>