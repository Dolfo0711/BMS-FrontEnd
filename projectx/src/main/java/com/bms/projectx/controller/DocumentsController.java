package com.bms.projectx.controller;

import com.bms.projectx.entity.DocumentEntity;
import com.bms.projectx.service.DocumentService;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;

import java.io.IOException;
import java.util.List;

@RestController
@RequestMapping("/api/documents")
public class DocumentsController {

    private final DocumentService documentService;

    public DocumentsController(DocumentService documentService) {
        this.documentService = documentService;
    }

    // GET /api/documents
    @GetMapping
    public ResponseEntity<List<DocumentEntity>> index() {
        return ResponseEntity.ok(documentService.findAll());
    }

    // GET /api/documents/{id}
    @GetMapping("/{id}")
    public ResponseEntity<DocumentEntity> show(@PathVariable Long id) {
        return ResponseEntity.ok(documentService.findById(id));
    }

    // GET /api/documents/user/{userId}
    @GetMapping("/user/{userId}")
    public ResponseEntity<List<DocumentEntity>> findByUser(
            @PathVariable Long userId) {
        return ResponseEntity.ok(documentService.findByUserId(userId));
    }

    // POST /api/documents
    @PostMapping(consumes = "multipart/form-data")
    public ResponseEntity<DocumentEntity> store(
            @RequestParam String name,
            @RequestParam String type,
            @RequestParam MultipartFile file
    ) throws IOException {

        DocumentEntity created = documentService.save(
                name,
                type,
                file
        );

        return new ResponseEntity<>(created, HttpStatus.CREATED);
    }

    // PUT /api/documents/{id}
    @PutMapping("/{id}")
    public ResponseEntity<DocumentEntity> update(
            @PathVariable Long id,
            @RequestBody DocumentEntity document) {

        return ResponseEntity.ok(
                documentService.update(id, document)
        );
    }

    // DELETE /api/documents/{id}
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> destroy(@PathVariable Long id) {

        documentService.delete(id);

        return ResponseEntity.noContent().build();
    }
}