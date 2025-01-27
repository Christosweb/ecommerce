<!-- Open the modal using ID.showModal() method -->
<!-- <button class="btn" onclick="my_modal_1.showModal()">open modal</button> -->
<dialog id="my_modal_1" class="modal">
  <div class="modal-box">
    <h3 class="text-lg font-bold text-black" id="status">success!</h3>
    <p class="py-4 font-bold text-lg text-black text-uppercase" id="message">cart added successfully</p>
    <div class="modal-action">
      <form method="dialog">
        <!-- if there is a button in form, it will close the modal -->
        <button class="btn btn-modal">Close</button>
      </form>
    </div>
  </div>
</dialog>