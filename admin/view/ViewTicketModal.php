<!-- View Ticket Modal -->
<aside class="modal fade" id="viewTicketModal" tabindex="-1" aria-labelledby="viewTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content md-cont">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="viewTicketModalLabel">Ticket Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="viewTicketModalBody">
                <form id="view-ticket-form">
                    <div class="col-12">
                        <div class="col-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="view-ticket-id">Ticket ID</label>
                                    <input type="text" class="form-control" id="view-ticket-id" name="view-ticket-id" readonly>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <div class="row">
                                <button type="button" class="btn btn-type" id="view-ticket-type" name="view-ticket-type">
                                    <span id="view-ticket-type-text"></span>
                                </button>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                <button type="button" class="btn btn-status" id="view-ticket-status" name="view-ticket-status">
                                    <span id="view-ticket-status-text"></span>
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</aside>
