import http from './Http';

class UploadFilesService {
    uploadArtFile(file, formData, onUploadProgress) {

        formData.append("file", file);

        return http.post("/upload", formData, {
            headers: {
                "Content-Type": "multipart/form-data"
            },
            onUploadProgress
        });
    }

    getFiles() {
        return http.get("/files");
    }
}

export default new UploadFilesService();
