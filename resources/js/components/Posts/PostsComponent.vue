<template>
  <div>
    <!-- <button type="button" class="btn btn-primary" @click="trigger()">Trigger</button> -->
      <posts-list :posts="posts" :get_posts="getPosts"></posts-list>
  </div>
</template>
<script>
export default {
  data() {
    return {
      posts: []
    };
  },
  created() {
    Echo.channel("PostChannel").listen("PostEvent", data => {
      this.getPosts();
    });
  },
  methods: {
    async getPosts() {
      let { data, status } = await axios.get("/posts");
      if (status == 200) {
        this.posts = data;
      }
    },
    trigger() {
      let senddata = "abing";
      let { data, status } = axios.post("/triggerMyEvent", senddata);
    },
    notifyMe() {
      Echo.channel("MyChannel").listen("MyEvent", function(data) {
        console.log("Hai!!  This is from Mounted function");
        console.log(JSON.stringify(data));
      });
    }
  },
  mounted() {
    this.getPosts();
    this.notifyMe();
  }
};
</script>>