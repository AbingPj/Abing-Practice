<template>
  <button
    :id="post.id"
    class="btn btn-sm ld-ext-left"
    :class="{ 'running': isRunning, 'btn-info': post.like, 'btn-outline-info': !post.like}"
    :disabled="isDisable"
    @click="btnLikePost(post.id)"
  >
    <!--  -->
    <img src="/img/luffy.svg" width="15px;" height="15px;" class="ld ld-tick" />
    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
    {{ post.like ? 'Liked' : 'like' }}
    <!--  -->
  </button>
</template>
<script>
export default {
  props: {
    postdata: Object
  },
  watch: {
    postdata: function(newVal, oldValue) {
      console.log("WATCH " + newVal.id);
      if (newVal.like != oldValue.like) {
        console.log("UNLIKE");
        this.post = newVal;
        this.reset();
      }
    }
  },

  data() {
    return {
      post: this.postdata,
      isDisable: false,
      isRunning: false
    };
  },

  methods: {
    async btnLikePost(id) {
      this.isRunning = true;
      this.isDisable = true;
      // let { status, data } = await axios.post("/posts/like/" + id);

      await axios
        .post("/posts/like/" + id)
        .then(function(response) {
          if (response.data === 401) {
            LoadingOverlay();
            setTimeout(() => {
              window.location.href = "/login";
            }, 2000);
          }

          if (!response.status == 200) {
            this.reset();
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    reset() {
      this.isDisable = false;
      this.isRunning = false;
    }
  },
  mounted() {
    this.$events.listen("reset-like", data => this.reset());
  }
};
</script>