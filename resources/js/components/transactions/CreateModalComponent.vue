<template>
  <div class="modal-custom">
      <div class="modal-box">
          <form action="#">
              
          </form>
      </div>
  </div>
</template>

<script>
export default {
    name: 'create-modal-component'
}
</script>

<style lang="scss" scoped>
    .modal-custom {
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 999;
        background-color: rgba(0, 0, 0, 0.59);
        display: flex;
        justify-content: center;
        align-items: center;
        .modal-box{
            background: #fff;
            width: 40%;
            @media(max-width: 770px){
                width: 90%
            }
        }
    }
</style>