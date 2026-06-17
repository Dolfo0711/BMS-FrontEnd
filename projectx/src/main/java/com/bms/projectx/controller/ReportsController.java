package com.bms.projectx.controller;

import com.bms.projectx.entity.ReportEntity;
import com.bms.projectx.service.ReportService;
import lombok.RequiredArgsConstructor;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;

import java.io.IOException;
import java.math.BigDecimal;
import java.util.List;

@RestController
@RequestMapping("/api/reports")
@RequiredArgsConstructor
public class ReportsController {

    private final ReportService reportService;

    // GET /api/reports
    @GetMapping
    public ResponseEntity<List<ReportEntity>> index() {
        return ResponseEntity.ok(reportService.findAll());
    }

    // GET /api/reports/{id}
    @GetMapping("/{id}")
    public ResponseEntity<ReportEntity> show(
            @PathVariable Long id) {

        return ResponseEntity.ok(
                reportService.findById(id)
        );
    }

    // GET /api/reports/user/{userId}
    @GetMapping("/user/{userId}")
    public ResponseEntity<List<ReportEntity>> findByUser(
            @PathVariable Long userId) {

        return ResponseEntity.ok(
                reportService.findByUserId(userId)
        );
    }

    // POST /api/reports
    @PostMapping(consumes = "multipart/form-data")
    public ResponseEntity<ReportEntity> store(
            @RequestParam String type,
            @RequestParam Long equipmentId,
            @RequestParam BigDecimal latitude,
            @RequestParam BigDecimal longitude,
            @RequestParam MultipartFile picture
    ) throws IOException {

        ReportEntity created = reportService.save(
                type,
                equipmentId,
                latitude,
                longitude,
                picture
        );

        return new ResponseEntity<>(
                created,
                HttpStatus.CREATED
        );
    }

    // PUT /api/reports/{id}
    @PutMapping("/{id}")
    public ResponseEntity<ReportEntity> update(
            @PathVariable Long id,
            @RequestBody ReportEntity report
    ) {

        return ResponseEntity.ok(
                reportService.update(id, report)
        );
    }

    // DELETE /api/reports/{id}
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> destroy(
            @PathVariable Long id
    ) {

        reportService.delete(id);

        return ResponseEntity.noContent().build();
    }
}