<!-- Modal -->
<div class="modal fade" id="sitting-tables-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="SittingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="SittingModalLabel">Reservation Table</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url('admin/sitting-structure/table/store')}}" method="post">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Table Name</label>
                <input type="text" class="form-control" name="name" placeholder="Table Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">No of Guests</label>
                <input type="number" min="1" class="form-control" name="guests" placeholder="No of Guests">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>