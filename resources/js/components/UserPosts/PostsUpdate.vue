<template>
  <div>
    <div class="modal fade" id="updatePostModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Update Post</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="title">Title</label>
                <input
                  v-model="updateData.title"
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
                  v-model="updateData.content"
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
                  v-model="updateData.description"
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
                <button @click="submitUpdate()" class="btn btn-info" data-dismiss="modal">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    updateData: Object
  },
  data() {
    return {
      file: ""
    };
  },

  methods: {
    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    },
    async submitUpdate() {
      LoadingOverlay();
      let formData = new FormData();
      formData.append("image", this.file);
      formData.append("title", this.updateData.title);
      formData.append("content", this.updateData.content);
      formData.append("description", this.updateData.description);
      formData.append("id", this.updateData.id);
      let { status } = await axios.post("/posts/update", formData, {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      });
      if (status == 200) {
        this.$events.fire("refreshVueTable", status);
        LoadingOverlayHide();
      } else {
        console.log("Faild to Update");
        LoadingOverlayHide();
      }
    }
  }
};
</script>