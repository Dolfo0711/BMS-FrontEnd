package com.bms.projectx.service;

import com.bms.projectx.entity.EquipmentEntity;
import com.bms.projectx.entity.ReportEntity;
import com.bms.projectx.entity.UserEntity;
import com.bms.projectx.repository.EquipmentRepository;
import com.bms.projectx.repository.ReportRepository;
import com.bms.projectx.repository.UserRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.stereotype.Service;
import org.springframework.web.multipart.MultipartFile;

import java.io.File;
import java.io.IOException;
import java.math.BigDecimal;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.time.LocalDateTime;
import java.util.List;
import java.util.UUID;

@Service
@RequiredArgsConstructor
public class ReportService {

    private final ReportRepository reportRepository;
    private final UserRepository userRepository;
    private final EquipmentRepository equipmentRepository;

    public List<ReportEntity> findAll() {
        return reportRepository.findAll();
    }

    public ReportEntity findById(Long id) {
        return reportRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Report not found"));
    }

    public List<ReportEntity> findByUserId(Long userId) {
        return reportRepository.findByUserId(userId);
    }

    public ReportEntity save(
            String type,
            Long equipmentId,
            BigDecimal latitude,
            BigDecimal longitude,
            MultipartFile picture
    ) throws IOException {

        Authentication auth =
                SecurityContextHolder.getContext().getAuthentication();

        String email = auth.getName();

        UserEntity user = userRepository.findByEmail(email)
                .orElseThrow(() -> new RuntimeException("User not found"));

        EquipmentEntity equipment = equipmentRepository.findById(equipmentId)
                .orElseThrow(() -> new RuntimeException("Equipment not found"));

        String uploadDir = "uploads/reports/";

        File dir = new File(uploadDir);

        if (!dir.exists()) {
            dir.mkdirs();
        }

        String fileName =
                UUID.randomUUID() + "_" + picture.getOriginalFilename();

        Path path = Paths.get(uploadDir, fileName);

        Files.copy(picture.getInputStream(), path);

        ReportEntity report = new ReportEntity();

        report.setType(type);
        report.setDate(LocalDateTime.now());
        report.setPicture(uploadDir + fileName);
        report.setLatitude(latitude);
        report.setLongitude(longitude);
        report.setUser(user);
        report.setEquipment(equipment);

        return reportRepository.save(report);
    }

    public ReportEntity update(
            Long id,
            ReportEntity request
    ) {

        ReportEntity report = findById(id);

        report.setType(request.getType());

        if (request.getLatitude() != null) {
            report.setLatitude(request.getLatitude());
        }

        if (request.getLongitude() != null) {
            report.setLongitude(request.getLongitude());
        }

        if (request.getEquipment() != null) {
            EquipmentEntity equipment = equipmentRepository.findById(
                    request.getEquipment().getId()
            ).orElseThrow(() ->
                    new RuntimeException("Equipment not found"));

            report.setEquipment(equipment);
        }

        return reportRepository.save(report);
    }

    public void delete(Long id) {

        ReportEntity report = findById(id);

        // Optional: delete uploaded image
        if (report.getPicture() != null) {
            try {
                Files.deleteIfExists(
                        Paths.get(report.getPicture())
                );
            } catch (Exception ignored) {
            }
        }

        reportRepository.delete(report);
    }
}