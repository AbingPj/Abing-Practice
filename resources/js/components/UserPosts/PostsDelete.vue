<template>
  <div>
    <div class="modal fade" id="deletePostModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Delete Post</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <p>
              Are you sure you want to delete this post:
              <br />Title:&nbsp;[ &nbsp;
              <b>{{post.title}}</b> &nbsp;]?
            </p>
            <center>
              <button @click="deletePost()" class="btn btn-danger" data-dismiss="modal">Yes</button>

              <button class="btn btn-secondary" data-dismiss="modal">No</button>
            </center>
          </div>

          <!-- Modal footer -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    post: Object
  },
  methods: {
    async deletePost() {
      LoadingOverlay();
      let { status } = await axios.delete("/posts/delete/" + this.post.id);
      if (status == 200) {
        this.$events.fire("refreshVueTable", status);
        LoadingOverlayHide();
      } else {
        console.log("Failed Update");
        LoadingOverlayHide();
      }
    }
  }
};
</script>