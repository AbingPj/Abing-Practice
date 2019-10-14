<style lang="scss" scoped>
.marginTop {
  margin-top: 1%;
}
.buttonFloatRight {
  margin-top: 10px;
  float: right;
}

// img {
//   margin-top: 5px;
//   margin-bottom: 5px;
//   width: 100%;
//   height: auto;
// }

.textShadow {
  color: white;
  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
}
</style>
<template>
  <div>
    <!-- Create Button -->

    <h1 class="my-4">
      {{ username }}
      <small>
        posts!
        <div class="buttonFloatRight">
          <button
            v-if="guest === 'false'"
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#createPostModal"
          >
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Create More Post!
          </button>
        </div>
      </small>
    </h1>

    <posts-create></posts-create>
    <posts-update :updateData="updateData"></posts-update>
    <posts-delete :post="deleteData"></posts-delete>

    <div v-for="data in userPosts.slice().reverse()" :key="data.id">
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

          <div v-if="guest === 'false'">
            <button
              @click="btnUpdate(data)"
              class="btn btn-info btn-sm"
              data-toggle="modal"
              data-target="#updatePostModal"
            >
              <i class="fa fa-edit"></i>
            </button>

            <button
              @click="btnRemove(data)"
              class="btn btn-danger btn-sm"
              data-toggle="modal"
              data-target="#deletePostModal"
            >
              <i class="fa fa-trash"></i>
            </button>
          </div>
        </div>
        <div class="card-footer text-muted">
          Posted on {{ data.created_at }}
          <!-- <a href="#">{{data.submitted_by}}</a> -->
        </div>
      </div>
    </div>
    <!--  -->

    <!-- VUE FOR LOOP -->
    <!-- <div v-for="data in userPosts.slice().reverse()" :key="data.id">
      <div class="row marginTop">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-5 col-md-12">
                  <img class="img-thumbnail" :src="data.image " />
                  <br />
                </div>
                <div class="col-lg-7 col-md-12">
                  <h3 class="card-title">{{data.title}}</h3>
                  <p class="card-text">{{ updateContent(data.content, 200) }}</p>
                  <p>
                    <b>Description:</b>
                    {{updateContent(data.description , 50) }}
                  </p>
                  <small>
                    Likes:
                    <span class="badge badge-info">{{data.likes}}</span>
                  </small>
                  <br />
                  <br />
                  <p>
                    <small>
                      <posts-like-button :postdata="data"></posts-like-button>
                    </small>
                    <small class="buttonFloatRight">
                      <button
                        @click="btnUpdate(data)"
                        class="btn btn-info btn-sm"
                        data-toggle="modal"
                        data-target="#updatePostModal"
                      >
                        <i class="fa fa-edit"></i>
                      </button> &nbsp;
                      <button
                        @click="btnRemove(data)"
                        class="btn btn-danger btn-sm"
                        data-toggle="modal"
                        data-target="#deletePostModal"
                      >
                        <i class="fa fa-trash"></i>
                      </button>
                    </small>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>-->
    <!-- END OF FOR LOOp -->
  </div>
</template>
<script>
import { setTimeout } from "timers";
export default {
  props: {
    id: String,
    username: String,
    guest: String
  },
  data() {
    return {
      userPosts: [],
      updateData: {},
      deleteData: {}
    };
  },
  created() {
    this.getUserPosts();
    Echo.channel("UserPostChannel").listen("UserPostEvent", data => {
      console.log(data.userId);
      if (data.userId == this.id) {
        this.getUserPosts();
      }
    });
  },

  methods: {
    async getUserPosts() {
      let that = this;
      await axios
        .get("/getuser-posts/" + this.id)
        .then(function(response) {
          that.userPosts = response.data;
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    // async getUserPosts() {
    //   let { data, status } = await axios.get("/getuser-posts/" + this.id);
    //   if (status == 200) {
    //     this.userPosts = data;
    //   } else {
    //     alert("500");
    //     this.$events.fire("reset-like", data);
    //   }
    // },
    updateContent(text, length) {
      if (text.length > length) {
        let str = text;
        let newText = str.substring(0, length);
        return newText.concat(".....");
      } else {
        return text;
      }
    },
    btnUpdate(data) {
      let dataToUpdate = { ...data };
      this.updateData = dataToUpdate;
    },
    btnRemove(data) {
      let dataToDelete = { ...data };
      this.deleteData = dataToDelete;
    },
    btnLikePost(id) {
      setTimeout(() => {
        let { status } = axios.post("/posts/like/" + id);
      }, 3000);
    }
  }
};
</script>