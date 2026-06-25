package com.bms.projectx.service;

import com.bms.projectx.entity.EquipmentEntity;
import com.bms.projectx.repository.EquipmentRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@RequiredArgsConstructor
public class EquipmentService {

    private final EquipmentRepository equipmentRepository;

    public List<EquipmentEntity> findAll() {
        return equipmentRepository.findAll();
    }

    public EquipmentEntity findById(Long id) {
        return equipmentRepository.findById(id)
                .orElseThrow(() ->
                        new RuntimeException("Equipment not found"));
    }

    public EquipmentEntity save(
            EquipmentEntity equipment) {

        return equipmentRepository.save(equipment);
    }

    public EquipmentEntity update(
            Long id,
            EquipmentEntity request) {

        EquipmentEntity equipment = findById(id);

        equipment.setName(request.getName());
        equipment.setType(request.getType());
        equipment.setModel(request.getModel());
        equipment.setSerialNumber(request.getSerialNumber());

        return equipmentRepository.save(equipment);
    }

    public void delete(Long id) {

        EquipmentEntity equipment = findById(id);

        equipmentRepository.delete(equipment);
    }
}