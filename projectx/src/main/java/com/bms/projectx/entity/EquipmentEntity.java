package com.bms.projectx.entity;

import jakarta.persistence.*;
import lombok.*;


@Entity
@Table(name = "equipments")
@Data
@NoArgsConstructor
@AllArgsConstructor
public class EquipmentEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String name;

    private String type;

    private String model;

    private String serialNumber;
}