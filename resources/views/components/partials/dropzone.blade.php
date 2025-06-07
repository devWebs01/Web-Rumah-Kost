<style>
    #dropZone {
        border: 2px dashed #bbb;
        border-radius: 5px;
        padding: 50px;
        text-align: center;
        font-size: 21pt;
        font-weight: bold;
        color: #bbb;
        width: 100%;
        display: block;
    }

    /* Scrollbar kecil tapi tetap terlihat */
    .overflow-auto {
        scrollbar-width: thin;
        /* Untuk Firefox */
        -ms-overflow-style: none;
        /* Untuk Internet Explorer dan Edge */
    }

    .overflow-auto::-webkit-scrollbar {
        width: 5px;
        /* Untuk Chrome, Safari, dan Opera */
        height: 5px;
    }

    .overflow-auto::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.3);
        /* Warna thumb (pegangan scrollbar) */
        border-radius: 10px;
    }

    .overflow-auto::-webkit-scrollbar-track {
        background: transparent;
        /* Background track dibuat transparan */
    }
</style>
