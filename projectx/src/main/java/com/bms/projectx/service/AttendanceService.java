package com.bms.projectx.service;

import com.bms.projectx.entity.AttendanceEntity;
import com.bms.projectx.entity.UserEntity;
import com.bms.projectx.repository.AttendanceRepository;
import com.bms.projectx.repository.UserRepository;
import com.cloudinary.Cloudinary;
import com.cloudinary.utils.ObjectUtils;
import org.springframework.beans.factory.annotation.Autowired;
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
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.*;

@Service
public class AttendanceService {

    private final AttendanceRepository attendanceRepository;
    private final UserRepository userRepository;

    public AttendanceService(AttendanceRepository attendanceRepository, UserRepository userRepository) {
        this.attendanceRepository = attendanceRepository;
        this.userRepository = userRepository;
    }

    public List<AttendanceEntity> findAll() {
        return attendanceRepository.findAll();
    }

    public AttendanceEntity findById(Long id) {
        return attendanceRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Attendance not found"));
    }

    public List<AttendanceEntity> findByUserId(Long userId) {
        List<AttendanceEntity> attendances =
                attendanceRepository.findByUserId(userId);

        Collections.reverse(attendances);

        return attendances;
    }

    public AttendanceEntity findUserAttendance(
            Long userId,
            Long attendanceId
    ) {

        AttendanceEntity attendance =
                attendanceRepository.findById(attendanceId)
                        .orElseThrow(() ->
                                new RuntimeException(
                                        "Attendance not found"
                                )
                        );


        if (!attendance.getUser().getId()
                .equals(userId)) {

            throw new RuntimeException(
                    "Attendance does not belong to this user"
            );
        }


        return attendance;
    }

    @Autowired
    private Cloudinary cloudinary;

    public AttendanceEntity punch(BigDecimal latitude, BigDecimal longitude, MultipartFile picture) throws IOException {

        // 1. Get logged-in user
        Authentication auth = SecurityContextHolder.getContext().getAuthentication();
        String email = auth.getName();

        UserEntity user = userRepository.findByEmail(email)
                .orElseThrow(() -> new RuntimeException("User not found"));

        // 2. Check today's latest attendance
        LocalDate today = LocalDate.now();
        LocalDateTime start = today.atStartOfDay();
        LocalDateTime end = today.atTime(23, 59, 59);

        Optional<AttendanceEntity> latest =
                attendanceRepository.findTopByUserIdAndDateTimeBetweenOrderByDateTimeDesc(
                        user.getId(),
                        start,
                        end
                );

        // 3. Decide IN or OUT
        String type;

        if (latest.isEmpty()) {
            type = "IN";
        } else {
            AttendanceEntity last = latest.get();

            if ("IN".equals(last.getType())) {
                type = "OUT";
            } else {
                type = "IN";
            }
        }

        // 4. Upload image
        Map uploadResult = cloudinary.uploader().upload(picture.getBytes(),
                ObjectUtils.asMap("folder", "attendance"));

        String imageUrl = uploadResult.get("url").toString();

        // 5. Save attendance
        AttendanceEntity attendance = new AttendanceEntity();
        attendance.setUser(user);
        attendance.setDateTime(LocalDateTime.now());
        attendance.setType(type);
        attendance.setLatitude(latitude);
        attendance.setLongitude(longitude);
        attendance.setPicture(imageUrl);

        return attendanceRepository.save(attendance);
    }

    public String getNextAction() {

        Authentication auth = SecurityContextHolder.getContext().getAuthentication();
        String email = auth.getName();

        UserEntity user = userRepository.findByEmail(email)
                .orElseThrow(() -> new RuntimeException("User not found"));

        LocalDate today = LocalDate.now();
        LocalDateTime start = today.atStartOfDay();
        LocalDateTime end = today.atTime(23, 59, 59);

        Optional<AttendanceEntity> latest =
                attendanceRepository.findTopByUserIdAndDateTimeBetweenOrderByDateTimeDesc(
                        user.getId(), start, end
                );

        if (latest.isEmpty()) {
            return "IN";
        }

        AttendanceEntity last = latest.get();

        if ("IN".equals(last.getType())) {
            return "OUT";
        }

        return "IN";
    }

    public AttendanceEntity update(Long id, AttendanceEntity attendance) {
        AttendanceEntity existing = findById(id);

        existing.setDateTime(attendance.getDateTime());
        existing.setType(attendance.getType());
        existing.setPicture(attendance.getPicture());
        existing.setLatitude(attendance.getLatitude());
        existing.setLongitude(attendance.getLongitude());
        existing.setUser(attendance.getUser());

        return attendanceRepository.save(existing);
    }

    public void delete(Long id) {
        attendanceRepository.deleteById(id);
    }
}