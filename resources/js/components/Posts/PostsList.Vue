<style>
.marginTop {
  margin-top: 1%;
}

.buttonFloatRight {
  float: right;
}

/* img {
  width: 100%;
  height: 100%;
} */

/* .div-wrapper {
   position: relative;
  height: 100%;
  width: 100%; 
} */

.post-image {
  margin-top: 5px;
  margin-bottom: 5px;
  width: 100%;
  height: auto;
}

.textShadow {
  color: white;
  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
}
</style>


<template>
  <div>
    <h1 class="my-4">
      Home
      <small>Explore Our Post!</small>
    </h1>

    <!-- Blog Post -->
    <div v-for="data in posts.slice().reverse()" :key="data.id">
      <div class="card mb-4">
        <img
          class="card-img-top"
          :src="data.image"
          width="750px"
          height="auto"
          alt="Card image cap"
        />
        <div class="card-body">
          <h2 class="card-title">{{data.title}}</h2>
          <p class="card-text">
            {{ updateContent(data.content, 200)}}
            <br />
            <small>
              Likes:
              <span class="badge badge-info">{{data.likes}}</span>
            </small>
            <br />
            <br />
            <posts-like-button :postdata="data"></posts-like-button>
          </p>
        </div>
        <div class="card-footer text-muted">
          Posted on {{ data.created_at }} by
          <a
            :href="updateUserPath(data.user.id)"
          >{{data.submitted_by}}</a>
        </div>
      </div>
    </div>

    <posts-update :updateData="updateData"></posts-update>
    <posts-delete :post="deleteData"></posts-delete>
  </div>
</template>
<script>
export default {
  props: {
    posts: Array
  },
  data() {
    return {
      updateData: {},
      deleteData: {}
    };
  },
  methods: {
    updateContent(text, length) {
      if (text.length > length) {
        let str = text;
        let newText = str.substring(0, length);
        return newText.concat(".....");
      } else {
        return text;
      }
    },

    updateUserPath(id) {
      let base = "/user-posts/";
      return base + id;
    },
    btnUpdate(data) {
      let dataToUpdate = { ...data };
      this.updateData = dataToUpdate;
    },
    btnRemove(data) {
      let dataToDelete = { ...data };
      this.deleteData = dataToDelete;
    }
    // async btnLikePost(id) {
    //   let { status } = await axios.post("/posts/like/" + id);
    // }
  }
};
</script>