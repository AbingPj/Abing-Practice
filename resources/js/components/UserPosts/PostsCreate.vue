<template>
  <div class="modal fade" id="createPostModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="title">Title</label>
              <input
                v-model="title"
                type="text"
                class="form-control"
                id="title"
                name="title"
                placeholder="Post Title here"
              />
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea
                v-model="content"
                class="form-control"
                id="content"
                name="content"
                rows="3"
                placeholder="Your Content Here....."
              ></textarea>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <input
                v-model="description"
                type="text"
                class="form-control"
                id="description"
                name="description"
                placeholder="description"
              />
            </div>
            <div class="form-group">
              <label for="file">Image</label>
              <input
                type="file"
                class="form-control"
                id="file"
                name="file"
                ref="file"
                v-on:change="handleFileUpload()"
              />
            </div>
            <div class="modal-footer">
              <button
                @click="submitPost()"
                type="submit"
                class="btn btn-info"
                data-dismiss="modal"
              >Post</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "",
      content: "",
      description: "",
      file: ""
    };
  },

  methods: {
    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    },

    async submitPost() {
      LoadingOverlay();
      let formData = new FormData();
      formData.append("image", this.file);
      formData.append("title", this.title);
      formData.append("content", this.content);
      formData.append("description", this.description);
      // formData.append("data", rawData);
      let { status } = await axios.post("/posts", formData, {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      });
      if (status == 200) {
        this.title = "";
        this.content = "";
        this.description = "";
        LoadingOverlayHide();
      } else {
        console.log("Faild to Add Post");
        LoadingOverlayHide();
      }
    }
  },
  mounted() {
    console.log("CreatePost Component mounted.");
  }
};
</script>