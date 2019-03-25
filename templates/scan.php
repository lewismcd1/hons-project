<style>
    @media (max-width: 768px){
        #scan-barcode-modal {
            margin-bottom: 50%;
        }
    }

    #test video {
        max-width: 100%;
    }
    .drawingBuffer {
        height: 20px;
    }
    #product-id-number {
        width: 70%;
    }
</style>
<!-- Scan Modal -->
<div class="modal fade" class="scan-barcode-modal" id="scan-barcode-modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Scan Barcode</h5>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="wrapper">
                    <div id="test"></div>
                    <div id="process"></div>
                    <div id="res"></div>
                </div>
                <input id='product-id-number' placeholder='Scan the barcode or enter it manually'/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id='rescan-btn'>Scan Again</button>
                <button type="button" class="btn btn-primary" id='find-product-btn'>Find Product</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>