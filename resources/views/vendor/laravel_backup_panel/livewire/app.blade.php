<div class="container mb-5">
    <div class="d-flex align-items-end pt-4" style="    justify-content: center;">
       <div class="top-line"></div>
        <div class="backup-panel-heading" >
            HRMS Backup Panel
        </div>
        
                {{--  create backup --}}

                <form action="{{ route('backup_file') }}" method="POST" style="display: flex; justify-content: flex-end;     margin-bottom: -59px;
                margin-left: -237px;">
                    @csrf <!-- Add this line to include CSRF token -->
                
                   {{-- added line  --}}
                   <div class="dropdown mr-2">
                    <button class="btn btn-primary initiate-backup-btn dropdown-toggle" type="button" id="exportDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select File
                    </button>
                    <div class="dropdown-menu" >
                        <select name="format" class="dropdown-item">
                            <option value="choose file"></option>
                            <option value="csv">CSV</option>
                            <option value="excel">Excel</option>
                            <option value="pdf">PDF</option>
                        </select>
                    </div>
                </div>
                
               
                   {{-- added line --}}
                   
                  <button type="submit" class="btn btn-primary initiate-backup-btn">Initiate Backup</button>

                </form>
                

    </div>

   
    <script>
        document.addEventListener('livewire:load', function () {
            @this.updateBackupStatuses()

            @this.on('backupStatusesUpdated', function () {
                @this.getFiles()
            })

            @this.on('showErrorToast', function (message) {
                Toastify({
                    text: message,
                    duration: 10000,
                    gravity: 'bottom',
                    position: 'right',
                    backgroundColor: 'red',
                    className: 'toastify-custom',
                }).showToast()
            })

            const backupFun = function (option = '') {
                Toastify({
                    text: 'Creating a new backup in the background...' + (option ? ' (' + option + ')' : ''),
                    duration: 5000,
                    gravity: 'bottom',
                    position: 'right',
                    backgroundColor: '#1fb16e',
                    className: 'toastify-custom',
                }).showToast()

                @this.createBackup(option)
            }

            $('#create-backup').on('click', function () {
                backupFun()
            })
            $('#create-backup-only-db').on('click', function () {
                backupFun('only-db')
            })
            $('#create-backup-only-files').on('click', function () {
                backupFun('only-files')
            })

            const deleteModal = $('#deleteModal')
            @this.on('showDeleteModal', function () {
                deleteModal.modal('show')
            })
            @this.on('hideDeleteModal', function () {
                deleteModal.modal('hide')
            })

            deleteModal.on('hidden.bs.modal', function () {
                @this.deletingFile = null
            })
        })
        // added script backup
        function setExportFormat(format) {
        document.getElementById('exportFormat').value = format;
    }
    // added script backup
    </script>
     <style>
        .backup-panel-heading {
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            font-size: 22px;
            font-weight: bold;
            color: #281086; 
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); 
            padding: 15px 20px; 
            border-radius: 20px; 
            text-align: center;
             padding: 20px 0;
            transition: all 0.3s ease; 
            display: inline-block; 
        }
        .backup-panel-heading::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #000; /* Change this to the color you prefer */
}
    
        .backup-panel-heading:hover {
            transform: scale(1.05); 
            color: #ff9b44; 
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }
        .initiate-backup-btn {
            background-color: #007bff; 
            color: white;
            padding: 10px 20px; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
        }

        .initiate-backup-btn:hover {
            background-color: #ff9b44;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
.top-line {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    height: 2px;
    background-image: linear-gradient(to right, #ff8c00, #ff0000); 
}

    </style>
    
</div>
