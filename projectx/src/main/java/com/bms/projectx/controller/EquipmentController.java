package com.bms.projectx.controller;

import com.bms.projectx.entity.EquipmentEntity;
import com.bms.projectx.service.EquipmentService;
import lombok.RequiredArgsConstructor;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/equipments")
@RequiredArgsConstructor
public class EquipmentController {

    private final EquipmentService equipmentService;

    // GET /api/equipments
    @GetMapping
    public ResponseEntity<List<EquipmentEntity>> index() {
        return ResponseEntity.ok(equipmentService.findAll());
    }

    // GET /api/equipments/{id}
    @GetMapping("/{id}")
    public ResponseEntity<EquipmentEntity> show(@PathVariable Long id) {
        return ResponseEntity.ok(equipmentService.findById(id));
    }

    // POST /api/equipments
    @PostMapping
    public ResponseEntity<EquipmentEntity> store(
            @RequestBody EquipmentEntity equipment) {

        EquipmentEntity created =
                equipmentService.save(equipment);

        return new ResponseEntity<>(
                created,
                HttpStatus.CREATED
        );
    }

    // PUT /api/equipments/{id}
    @PutMapping("/{id}")
    public ResponseEntity<EquipmentEntity> update(
            @PathVariable Long id,
            @RequestBody EquipmentEntity equipment) {

        return ResponseEntity.ok(
                equipmentService.update(id, equipment)
        );
    }

    // DELETE /api/equipments/{id}
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> destroy(
            @PathVariable Long id) {

        equipmentService.delete(id);

        return ResponseEntity.noContent().build();
    }
}