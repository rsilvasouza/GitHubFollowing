<template>
  <div class="d-grid gap-2">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBio">
      Bio
    </button>
  </div>
  
  <div class="modal fade" id="modalBio" tabindex="-1" aria-labelledby="modalBioLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{ bio }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  props: {
    bio: {
      type: String,
    },
  },

}
</script>