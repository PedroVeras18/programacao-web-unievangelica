import { Car, Prisma } from '@prisma/client'
import { CarsRepository } from '../cars-repository'
import { prisma } from '@/lib/prisma'

export class PrismaCarsRepository implements CarsRepository {
  async getAll(page: number) {
    const cars = await prisma.car.findMany({
      take: 20,
      skip: (page - 1) * 20,
    })

    return cars
  }

  async findById(id: string) {
    const car = await prisma.car.findUnique({
      where: {
        id,
      },
    })

    return car
  }

  async create(data: Prisma.CarUncheckedCreateInput) {
    const car = await prisma.car.create({
      data,
    })

    return car
  }

  async save(data: Car) {
    const car = await prisma.car.update({
      where: {
        id: data.id,
      },
      data,
    })

    return car
  }

  async delete(anId: string) {
    await prisma.car.delete({
      where: {
        id: anId,
      },
    })
  }
}
