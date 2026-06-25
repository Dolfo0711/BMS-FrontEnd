package com.bms.projectx.service;

import com.bms.projectx.entity.DocumentEntity;
import com.bms.projectx.entity.UserEntity;
import com.bms.projectx.repository.DocumentRepository;
import com.bms.projectx.repository.UserRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.stereotype.Service;
import org.springframework.web.multipart.MultipartFile;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.List;
import java.util.UUID;

@Service
@RequiredArgsConstructor
public class DocumentService {

    private final DocumentRepository documentRepository;
    private final UserRepository userRepository;

    public List<DocumentEntity> findAll() {
        return documentRepository.findAll();
    }

    public DocumentEntity findById(Long id) {
        return documentRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Document not found"));
    }

    public List<DocumentEntity> findByUserId(Long userId) {
        return documentRepository.findByUserId(userId);
    }

    public DocumentEntity save(
            String name,
            String type,
            MultipartFile file
    ) throws IOException {

        Authentication auth =
                SecurityContextHolder.getContext().getAuthentication();

        String email = auth.getName();

        UserEntity user = userRepository.findByEmail(email)
                .orElseThrow(() -> new RuntimeException("User not found"));

        String uploadDir = "uploads/documents/";

        File directory = new File(uploadDir);

        if (!directory.exists()) {
            directory.mkdirs();
        }

        String fileName =
                UUID.randomUUID() + "_" + file.getOriginalFilename();

        Path path = Paths.get(uploadDir, fileName);

        Files.copy(file.getInputStream(), path);

        DocumentEntity document = new DocumentEntity();

        document.setName(name);
        document.setType(type);
        document.setFile(uploadDir + fileName);
        document.setUser(user);

        return documentRepository.save(document);
    }

    public DocumentEntity update(Long id, DocumentEntity request) {

        DocumentEntity document = findById(id);

        document.setName(request.getName());
        document.setType(request.getType());

        return documentRepository.save(document);
    }

    public void delete(Long id) {

        DocumentEntity document = findById(id);

        documentRepository.delete(document);
    }
}